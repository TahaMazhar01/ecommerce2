import {writeFile,mkdir,cp} from 'node:fs/promises';
import path from 'node:path';
const root=path.resolve(import.meta.dirname,'..');
const files=[
 ['https://downloads.wordpress.org/plugin/woocommerce.latest-stable.zip','vendor/woocommerce.zip'],
 ['https://codeload.github.com/woocommerce/woocommerce-gateway-dummy/zip/refs/heads/master','vendor/dummy.zip'],
 ['https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=1600&q=82&fit=crop','assets/living-room.jpg'],
 ['https://raw.githubusercontent.com/google/fonts/main/ofl/playfairdisplay/PlayfairDisplay%5Bwght%5D.ttf','theme/assets/playfair.ttf'],
 ['https://raw.githubusercontent.com/google/fonts/main/ofl/inter/Inter%5Bopsz,wght%5D.ttf','theme/assets/inter.ttf'],
 ['https://raw.githubusercontent.com/google/fonts/main/ofl/playfairdisplay/OFL.txt','theme/assets/Playfair-OFL.txt'],
 ['https://raw.githubusercontent.com/google/fonts/main/ofl/inter/OFL.txt','theme/assets/Inter-OFL.txt']
];
for(let i=0;i<files.length;i+=3)await Promise.all(files.slice(i,i+3).map(async([url,file])=>{const r=await fetch(url);if(!r.ok)throw Error(file+': '+r.status);await writeFile(path.join(root,file),Buffer.from(await r.arrayBuffer()));console.log('Downloaded '+file)}));
