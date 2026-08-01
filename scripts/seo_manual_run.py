#!/usr/bin/env python3
"""Fire the daily pipeline detached so it survives SSH channel close."""
import subprocess, os

log = os.path.expanduser("~/seo-agent/logs/manual_run.log")
subprocess.Popen(
    ["./venv/bin/python", "main.py", "--mode", "daily-pipeline", "--count", "3"],
    cwd=os.path.expanduser("~/seo-agent"),
    stdin=subprocess.DEVNULL,
    stdout=open(log, "a"),
    stderr=subprocess.STDOUT,
    start_new_session=True,
)
print("pipeline launched ->", log)
