import {readFile,cp,mkdir} from 'node:fs/promises';import path from 'node:path';import {root,phpJob} from './runtime.mjs';
await cp(path.join(root,'theme'),path.join(root,'wordpress/wp-content/themes/nestora'),{recursive:true});await cp(path.join(root,'plugin'),path.join(root,'wordpress/wp-content/plugins/nestora-store'),{recursive:true});
await mkdir(path.join(root,'wordpress/wp-content/uploads/nestora'),{recursive:true});await cp(path.join(root,'assets'),path.join(root,'wordpress/wp-content/uploads/nestora'),{recursive:true});
const code=await readFile(path.join(root,'scripts/seed.php'),'utf8');for(let i=0;i<2;i++)console.log((await phpJob(code,'seed')).text);
