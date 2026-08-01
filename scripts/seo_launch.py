#!/usr/bin/env python3
"""Detach-launch the SEO agent runner so it survives SSH session close."""
import subprocess, os, sys

def launch(workdir, runner):
    log = os.path.join(workdir, "logs", "launcher.out")
    os.makedirs(os.path.dirname(log), exist_ok=True)
    p = subprocess.Popen(
        ["bash", runner],
        cwd=workdir,
        stdin=subprocess.DEVNULL,
        stdout=open(log, "a"),
        stderr=subprocess.STDOUT,
        start_new_session=True,
    )
    print(f"launched {runner} pid={p.pid}")

if __name__ == "__main__":
    launch(os.path.expanduser("~/seo-agent"), "runner.sh")
