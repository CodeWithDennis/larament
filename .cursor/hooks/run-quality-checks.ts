/// <reference types="node" />
import { spawnSync } from "node:child_process";

type StopHookInput = {
  status?: "completed" | "aborted" | "error";
};

const COMMANDS: Array<[string, string]> = [
  ["rector", "./vendor/bin/rector --ansi"],
  ["phpstan", "./vendor/bin/phpstan analyse --memory-limit=512M"],
];

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

function runCommand(_name: string, cmd: string): boolean {
  const result = spawnSync(cmd, {
    stdio: ["inherit", "pipe", "pipe"],
    shell: true,
  });
  const out = result.stdout?.toString() ?? "";
  const err = result.stderr?.toString() ?? "";
  if (out) process.stderr.write(out);
  if (err) process.stderr.write(err);
  return result.status === 0;
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

  const failures: string[] = [];
  for (const [tool, cmd] of COMMANDS) {
    if (!runCommand(tool, cmd)) {
      failures.push(tool);
    }
  }

  const output =
    failures.length > 0
      ? {
        followup_message: `Please fix the errors reported by ${failures.join(", ")}.\nDon't do any other investigation.`,
      }
      : {};
  process.stdout.write(JSON.stringify(output) + "\n");
}

main().catch((err) => {
  console.error("[run-quality-checks]", err);
  process.stdout.write(JSON.stringify({}) + "\n");
});
