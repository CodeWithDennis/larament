#!/bin/bash

set -uo pipefail

payload="$(cat)"

status="$(PAYLOAD="$payload" python3 - <<'PY'
import json
import os

payload = os.environ.get("PAYLOAD", "")

try:
    data = json.loads(payload)
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

failures=()

commands=(
    "pint|./vendor/bin/pint --dirty"
    "rector|./vendor/bin/rector --ansi"
    "phpstan|./vendor/bin/phpstan analyse --memory-limit=512M"
)

for entry in "${commands[@]}"; do
    tool="${entry%%|*}"
    cmd="${entry#*|}"

    if ! eval "$cmd"; then
        failures+=("$tool")
    fi
done

if (( ${#failures[@]} > 0 )); then
    printf 'Quality checks failed for: %s\n' "${failures[*]}" >&2
fi

printf '{}\n'
