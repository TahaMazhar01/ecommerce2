import {readFile} from 'node:fs/promises';
import {spawn} from 'node:child_process';
import path from 'node:path';
import {root} from './runtime.mjs';
export const tools=JSON.parse(await readFile(path.join(root,'runtime/mysql-tools.json'),'utf8'));
export async function mysql(sql,database='nestora_db'){
 return new Promise((resolve,reject)=>{const child=spawn(path.join(tools.bin,'mysql.exe'),['--defaults-extra-file='+path.join(root,'runtime/mysql-client.cnf'),'--batch','--skip-column-names','--raw','--default-character-set=utf8mb4',...(database?[database]:[])],{windowsHide:true});let output='',errors='';child.stdout.on('data',d=>output+=d);child.stderr.on('data',d=>errors+=d);child.on('error',reject);child.on('close',code=>code?reject(Error(errors)):resolve(output));child.stdin.end(sql)});
}
