import {spawn} from 'node:child_process';
import path from 'node:path';
import fs from 'node:fs';

// Find cloudflared executable
const possiblePaths = [
  'cloudflared',
  'C:\\Program Files (x86)\\cloudflared\\cloudflared.exe',
  'C:\\Program Files\\cloudflared\\cloudflared.exe',
  path.join(process.env.LOCALAPPDATA || '', 'Microsoft', 'WinGet', 'Links', 'cloudflared.exe')
];

let bin = 'cloudflared';
for (const p of possiblePaths) {
  if (p === 'cloudflared') continue;
  if (fs.existsSync(p)) {
    bin = p;
    break;
  }
}

console.log('Connecting Nestora local store to Cloudflare Tunnel (100% Free Public URL)...');

const proc = spawn(bin, ['tunnel', '--url', 'http://127.0.0.1:9500'], {
  stdio: ['ignore', 'pipe', 'pipe']
});

let urlFound = false;

function scanOutput(data) {
  const text = data.toString();
  const match = text.match(/https:\/\/[a-z0-9-]+\.trycloudflare\.com/i);
  if (match && !urlFound) {
    urlFound = true;
    console.log('\n============================================================');
    console.log('🎉 YOUR LIVE STORE IS READY!');
    console.log('Public URL: \x1b[32m\x1b[1m' + match[0] + '\x1b[0m');
    console.log('============================================================\n');
    console.log('You can share this link with anyone anywhere in the world.');
    console.log('Press Ctrl + C anytime to stop.\n');
  }
}

proc.stdout.on('data', scanOutput);
proc.stderr.on('data', scanOutput);

proc.on('error', (err) => {
  console.error('Failed to launch cloudflared:', err.message);
});

proc.on('close', (code) => {
  if (code !== 0) {
    console.log(`Tunnel exited with code ${code}`);
  }
});

process.on('SIGINT', () => {
  proc.kill();
  process.exit(0);
});
