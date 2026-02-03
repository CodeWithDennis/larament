/// <reference types="node" />
import { spawnSync } from "node:child_process";

type StopHookInput = {
  status?: "completed" | "aborted" | "error";
};

const COMMAND = {
  tool: "phpstan",
  cmd: "./vendor/bin/phpstan analyse --memory-limit=512M",
};

async function parseInput(): Promise<StopHookInput> {
  const chunks: Buffer[] = [];
  for await (const chunk of process.stdin) {
    chunks.push(typeof chunk === "string" ? Buffer.from(chunk) : chunk);
  }
  const text = Buffer.concat(chunks).toString("utf8");
  try {
    return JSON.parse(text) as StopHookInput;
  } catch {
    return {};
  }
}

function hasGitChanges(): boolean {
  const result = spawnSync("git", [
    "status",
    "--porcelain",
    "--untracked-files",
  ]);
  return result.stdout.toString().trim().length > 0;
}

function runCommand(
  _name: string,
  cmd: string,
): { ok: boolean; output: string } {
  const result = spawnSync(cmd, {
    stdio: ["inherit", "pipe", "pipe"],
    shell: true,
  });
  const out = result.stdout?.toString() ?? "";
  const err = result.stderr?.toString() ?? "";
  const output = [out, err].filter(Boolean).join("\n").trim();
  if (output) process.stderr.write(output);
  return { ok: result.status === 0, output };
}

async function main(): Promise<void> {
  const input = await parseInput();

  if (input.status !== "completed") {
    process.stdout.write(JSON.stringify({}) + "\n");
    return;
  }

  if (!hasGitChanges()) {
    process.stdout.write(JSON.stringify({}) + "\n");
    return;
  }

  const MAX_ERROR_CHARS = 1000;

  const { ok, output } = runCommand(COMMAND.tool, COMMAND.cmd);
  const failures = ok ? [] : [{ tool: COMMAND.tool, output }];

  const truncatedOutput =
    output && output.length > MAX_ERROR_CHARS
      ? output.slice(0, MAX_ERROR_CHARS) + "\n… (truncated)"
      : output || "(no output)";

  const result =
    failures.length > 0
      ? {
        followup_message: [
          `Please fix the errors reported by ${COMMAND.tool}.`,
          "Don't do any other investigation.",
          "",
          `<${COMMAND.tool}-errors>\n${truncatedOutput}\n</${COMMAND.tool}-errors>`,
        ].join("\n"),
      }
      : {};
  process.stdout.write(JSON.stringify(result) + "\n");
}

main().catch((err) => {
  console.error("[run-phpstan-on-stop]", err);
  process.stdout.write(JSON.stringify({}) + "\n");
});
