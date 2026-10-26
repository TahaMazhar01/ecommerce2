import net from 'node:net';
const ready=await new Promise(resolve=>{const socket=net.connect({host:'127.0.0.1',port:9336},()=>{socket.destroy();resolve(true)});socket.on('error',()=>resolve(false));});
if(!ready)throw Error('The local MySQL service on port 9336 is stopped. Start MySQL, or restore the handover into XAMPP following docs/START-HERE.md. Nestora uses its own nestora_db database.');
