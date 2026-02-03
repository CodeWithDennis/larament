#!/bin/bash

set -uo pipefail

payload="$(cat)"

status="$(printf '%s' "$payload" | python3 - <<'PY'
import json, sys

try:
    data = json.load(sys.stdin)
except json.JSONDecodeError:
    print("")
else:
    print(data.get("status", ""))
PY
)"

if [[ "$status" != "completed" ]]; then
    printf '{}\n'
    exit 0
fi

if ! git status --porcelain --untracked-files | grep -q '.'; then
    printf '{}\n'
    exit 0
fi

declare -A commands=(
    ["pint"]="./vendor/bin/pint --dirty"
    ["rector"]="./vendor/bin/rector --ansi"
    ["phpstan"]="./vendor/bin/phpstan analyse --memory-limit=512M"
)

failures=()

for tool in "${!commands[@]}"; do
    if ! eval "${commands[$tool]}"; then
        failures+=("$tool")
    fi
done

if (( ${#failures[@]} > 0 )); then
    printf 'Quality checks failed for: %s\n' "${failures[*]}" >&2
fi

printf '{}\n'
