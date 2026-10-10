document.getElementById('burger').onclick=()=>document.getElementById('nav').classList.toggle('open');
const io=new IntersectionObserver(r=>r.forEach(x=>x.isIntersecting&&x.target.classList.add('in')));document.querySelectorAll('.card,.stat,h2').forEach(e=>{e.classList.add('rv');io.observe(e)});
document.querySelectorAll('form[data-v]').forEach(f=>f.onsubmit=ev=>{let bad=0;f.querySelectorAll('[required]').forEach(i=>{const m=i.nextElementSibling;const ko=!i.value.trim()||(i.type=='email'&&!/^\S+@\S+\.\S+$/.test(i.value));if(m&&m.className=='err')m.remove();if(ko){bad=1;i.insertAdjacentHTML('afterend','<div class="err">Required / invalid</div>')}});if(bad)ev.preventDefault()});
const S={economy:[12,3,6],standard:[18,4.5,3],express:[30,7,1]};const c=document.getElementById('calc');
if(c)c.onsubmit=e=>{e.preventDefault();const v=n=>c.elements[n].value;if(!v('o')||!v('d')||+v('w')<=0){document.getElementById('res').innerHTML='<p class="err">Fill origin, destination and weight.</p>';return}
const [b,r,dd]=S[v('s')],m=v('o').trim().toLowerCase()==v('d').trim().toLowerCase()?1:1.6,vol=v('l')*v('wd')*v('h')/5000,w=Math.max(+v('w'),vol||0),p=((b+w*r)*m).toFixed(2),dt=new Date(Date.now()+864e5*(dd+(m>1?2:0)));
document.getElementById('res').innerHTML='<div class="ok"><b>Estimated Price:</b> $'+p+'<br><b>Estimated Delivery Date:</b> '+dt.toDateString()+'</div>'};
