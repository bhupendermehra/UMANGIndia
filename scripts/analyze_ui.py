#!/usr/bin/env python3
"""Analyze a UI screenshot via OpenRouter vision (bypasses broken DeepSeek vision config)."""
import base64, json, os, sys, urllib.request, urllib.error

def analyze(path, prompt):
    key = [l.split("=",1)[1].strip() for l in open(os.path.expanduser("~/AppData/Local/hermes/.env")).read().splitlines() if l.startswith("OPENROUTER_API_KEY=")][0]
    img = base64.b64encode(open(path,"rb").read()).decode()
    body = {"model":"openai/gpt-4o-mini","messages":[{"role":"user","content":[
        {"type":"text","text":prompt},
        {"type":"image_url","image_url":{"url":"data:image/png;base64,"+img}}]}],"max_tokens":900}
    req = urllib.request.Request("https://openrouter.ai/api/v1/chat/completions",
        data=json.dumps(body).encode(), headers={"Authorization":"Bearer "+key,"Content-Type":"application/json"})
    try:
        resp = json.load(urllib.request.urlopen(req, timeout=90))
        return resp["choices"][0]["message"]["content"]
    except urllib.error.HTTPError as e:
        return "HTTP "+str(e.code)+": "+e.read().decode()[:300]

if __name__ == "__main__":
    path = sys.argv[1]
    prompt = sys.argv[2] if len(sys.argv) > 2 else (
        "Act as a blunt senior web designer. List every visual problem in this screenshot: "
        "ugly colors, misalignment, bad spacing, broken layout, weak hierarchy, unprofessional details. "
        "Be specific with exact locations (header, hero, cards, footer). Number each issue.")
    print(analyze(path, prompt))
