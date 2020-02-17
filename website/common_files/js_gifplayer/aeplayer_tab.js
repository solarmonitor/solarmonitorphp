var aep={cross:{addListener:function(a,c,b){
	if(a.addEventListener){
		a.addEventListener(c,b,false);
		}
	else{
		if(a.attachEvent){
			a.attachEvent("on"+c,b);
			}
		}
	},removeListener:
			function(a,c,b){
				if(a.removeEventListener){
					a.removeEventListener(c,b,false);
					}
				else{
					if(a.detachEvent){
						a.detachEvent("on"+c,b);
						}
					}
				},getFirstChildWithClass:
					function(c,e){
						var d,b,a;
						d=new RegExp("(^|\\s)"+e+"(\\s|$)");
						for(a=0;a<c.childNodes.length;a++){
							b=c.childNodes[a];
							if(d.test(b.className)){
								return b;
								}
							}
						return
						},getElementsByClassName:
							function(b,a,c){
							if(document.getElementsByClassName){
								this.getElementsByClassName=function(j,m,h){
									h=h||document;
									var d=h.getElementsByClassName(j),l=(m)?new RegExp("\\b"+m+"\\b","i"):null,e=[],g,f,k;
									for(f=0,k=d.length;f<k;f+=1){
										g=d[f];
										if(!l||l.test(g.nodeName)){
											e.push(g);
											}
										}
									return e;
									}
								}
							else{
								if(document.evaluate){
									this.getElementsByClassName=function(o,r,n){
										r=r||"*";n=n||document;
										var g=o.split(" "),p="",l="http://www.w3.org/1999/xhtml",q=(document.documentElement.namespaceURI===l)?l:null,h=[],d,f,i,k;
										for(i=0,k=g.length;i<k;i+=1){
											p+="[contains(concat(' ', @class, ' '), ' "+g[i]+" ')]"
											}
										try{
											d=document.evaluate(".//"+r+p,n,q,0,null);
											}
										catch(m){
											d=document.evaluate(".//"+r+p,n,null,0,null);
											}
										while((f=d.iterateNext())){
											h.push(f)
											}
										return h
										}
									}
								else{
									this.getElementsByClassName=function(r,u,q){
										u=u||"*";
										q=q||document;
										var h=r.split(" "),t=[],d=(u==="*"&&q.all)?q.all:q.getElementsByTagName(u),p,j=[],o,i,e,g,s,f,n;
										for(i=0,e=h.length;i<e;i+=1){
											t.push(new RegExp("(^|\\s)"+h[i]+"(\\s|$)"));
											}
										for(g=0,s=d.length;g<s;g+=1){
											p=d[g];
											o=false;
											for(f=0,n=t.length;f<n;f+=1){
												o=t[f].test(p.className);
												if(!o){
													break
													}
												}
											if(o){
												j.push(p);
												}
											}
										return j;
										}
									}
								}
							return this.getElementsByClassName(b,a,c);
							}
						},makeSlider:function(d){
							var c,f,j,l,e,b,o,k,i,n,h,g,m,a;
							i=function(q){
								var r,p;r=p=0;
								if(q.offsetParent){
									r=q.offsetLeft;
									p=q.offsetTop;
									while((q=q.offsetParent)){
										r+=q.offsetLeft;
										p+=q.offsetTop;
										}
									}
								return[r,p]
								       };
								       n=function(p){
								    	   if(p<f){
								    		   return f;
								    		   }
								    	   if(p>j){
								    		   return j;
								    		   }
								    	   p=Math.floor(p+0.5);
								    	   return p;
								    	   };
								    	   h=function(){
								    		   var p=((l-f)*o/(j-f));
								    		   c.style.left=p+"px";
								    		   };
								    	   g=function(q){
								    		   q=q||window.event;
								    		   if(q.preventDefault){
								    			   q.preventDefault();
								    			   }
								    		   var p=q.clientX-k.x;
								    		   p+=k.k;
								    		   p=(p<0)?0:p;
								    		   p=(p>o)?o:p;
								    		   c.style.left=p+"px";
								    		   p=f+(p*(j-f)/o);
								    		   p=Math.floor(p+0.5);
								    		   if(p!==l){
								    			   l=p;
								    			   if(e){
								    				   e(p);
								    				   }
								    			   }
								    		   return false;
								    		   };
								    	   m=function(p){
								    		   aep.cross.removeListener(document,"mouseup",m);
								    		   aep.cross.removeListener(document,"mousemove",g);
								    		   h();
								    		   return false;
								    		   };
								    	   a=function(q){
								    		   q=q||window.event;
								    		   if(q.preventDefault){
								    			   q.prevent Default();
								    			   }
								    		   var p=parseInt(c.style.left,10);
								    		   k={x:q.clientX,k:p};
								    		   aep.cross.addListener(document,"mouseup",m);
								    		   aep.cross.addListener(document,"mousemove",g);
								    		   return false;
								    		   };
								    	   c=aep.cross.getFirstChildWithClass(d,"knob");
								    	   f=0;
								    	   j=100;
								    	   l=0;
								    	   b=i(d)[0];
								    	   o=d.clientWidth-c.clientWidth;
								    	   c.style.position="relative";
								    	   h();
								    	   aep.cross.addListener(c,"mousedown",a);
								    	   return{
								    		   setValue:function(p){
								    		   l=n(p);
								    		   h();
								    		   return this;
								    		   },getValue:function(){
								    			   return l;
								    			   },setMin:function(p){
								    				   f=p;
								    				   return this;
								    				   },setMax:function(p){
								    					   j=p;
								    					   return this
								    					   },setListener:function(p){
								    						   e=p;
								    						   return this;
								    						   }
								    					   }
								    	   },makeButtonRepeater:function(c,i){
								    		   var d,j,f,e,g,b,h,a;
								    		   g=function(){
								    			   if(d){
								    				   i();
								    				   }
								    			   else{
								    				   d=true;
								    				   window.clearInterval(j);
								    				   j=window.setInterval(g,e);
								    				   }
								    			   };
								    		   b=function(){
								    				   d=false;
								    				   i();
								    				   j=window.setInterval(g,f);
								    				   };
								    		   h=function(){
								    				   window.clearInterval(j);
								    				   };
								    			   a=function(k){
								    				   k=k||window.event;
								    				   if(k.keyCode===32){i()}
								    				   };
								    			   f=750;
								    			   e=75;
								    			   aep.cross.addListener(c,"mousedown",b);
								    			   aep.cross.addListener(c,"mouseup",h);
								    			   aep.cross.addListener(c,"mouseout",h);
								    			   aep.cross.addListener(c,"keydown",a);
								    			   return{
								    				   setInitDelay:function(k){
								    				       f=k;
								    				       return this;
								    				       },setRepeatDelay:function(k){
								    				    	   e=k;
								    				    	   return this;
								    				    	   }
								    				       }
								    			   },makePlayerByEl:function(f){
								    				   var h,k,a,b,g,n,c,l,d,m,j,e;
								    				   l=function(){
								    					   var q,p,o;
								    					   a=(a+b)%b;
								    					   p=0;
								    					   for(q=0;q<m.length;q++){
								    						   if(a>=m[q].iframe){
								    							   p=q;
								    							   }
								    						   }
								    					   o=a-m[p].iframe;
								    					   f.style.backgroundImage=m[p].img;
								    					   f.style.backgroundPosition="0px -"+o*c+"px"};
								    					   d=function(){
								    						   a+=1;
								    						   l()
								    						   };
								    					   h=false;
								    					   n=0;
								    					   k=10;
								    					   a=0;
								    					   b=16;
								    					   m=[];
								    					   g=/\baepframes_(\d+)\b/.exec(f.className);
								    					   if(g){
								    						   b=parseInt(g[1],10);
								    						   }
								    					   m.push({iframe:0,img:f.style.backgroundImage});
								    					   j=aep.cross.getElementsByClassName("aeplayer_ext","div",f);
								    					   for(e=0;e<j.length;e++){
								    						   g=/\aepinitframe_(\d+)\b/.exec(j[e].className);
								    						   if(g){
								    							   m.push({iframe:parseInt(g[1],10),img:j[e].style.backgroundImage});
								    							   }
								    						   }
								    					   c=f.clientHeight;
								    					   return{
								    						   play:function(){
								    						     if(!h){
								    						    	 if(n){window.clearInterval(n)}
								    						    	 n=window.setInterval(d,1000/k);
								    						    	 h=true;
								    						    	 }
								    						     return this;
								    						     },pause:function(){
								    						    	 if(h){
								    						    		 window.clearInterval(n);
								    						    		 n=0;
								    						    		 h=false;
								    						    		 }
								    						    	 return this;
								    						    	 },isPaused:function(){
								    						    		 return !h;
								    						    		 },setFrame:function(i){
								    						    			 if(!h){
								    						    				 a=i;
								    						    				 l();
								    						    				 }
								    						    			 return this;
								    						    			 },getFrame:function(){
								    						    				 return a;
								    						    				 },setRate:function(i){
								    						    					 k=i;
								    						    					 if(h){
								    						    						 this.pause();
								    						    						 this.play();
								    						    						 }
								    						    					 return this;
								    						    					 },getRate:function(){
								    						    						 return k;
								    						    						 },setFrameCount:function(i){
								    						    							 b=i;
								    						    							 return this;
								    						    							 },getFrameCount:function(){
								    						    								 return b;
								    						    								 },getPlayerDiv:function(){
								    						    									 return f;
								    						    									 }
								    						    								 }
								    					   },makePlayer:function(b){
								    						   var a=document.getElementById(b);
								    						   if(!a){
								    							   return null;
								    							   }
								    						   return aep.makePlayerByEl(a);
								    						   },makePanel:function(s,p){
								    							   var j,b,w,x,q,n,r,h,m,g,k,l,a,c,t,f,d,o,u,v,e,i;
								    							   e=function(){
								    								   if(q){
								    									   if(s.isPaused()){
								    										   q.innerHTML=v.replace("%d",s.getFrame());
								    										   }
								    									   else{
								    										   q.innerHTML=u.replace("%d",s.getRate());
								    										   }
								    									   }
								    								   };
								    							   i=function(){
								    								   if(b){
								    									   if(s.isPaused()){
								    										   b.className="playpause play";
								    										   b.innerHTML=d;
								    										   }
								    									   else{
								    										   b.className="playpause pause";
								    										   b.innerHTML=o;
								    										   }
								    									   }
								    								   };
								    							   k=function(){
								    								   e();
								    								   i();
								    								   };
								    							   l=function(y){
								    								   if(s.isPaused()){
								    									   s.setFrame(y);
								    									   }
								    								   else{
								    									   s.setRate(y);
								    									   }
								    								   k();
								    								   };
								    						       a=function(){
								    						    	   if(s.isPaused()){
								    						    		   if(r){
								    						    			   r.setMin(h).setMax(m).setValue(s.getRate());
								    						    			   }
								    						    		   s.play();
								    						    		   }
								    						    	   else{
								    						    		   s.pause();
								    						    		   if(r){
								    						    			   r.setMin(0).setMax(s.getFrameCount()-1).setValue(s.getFrame());
								    						    			   }
								    						    		   }
								    						    	   k();
								    						    	   };
								    						        c=function(y){
								    						        	if(s.isPaused()){
								    						        		s.setFrame(s.getFrame()+y);
								    						        		if(r){
								    						        			r.setValue(s.getFrame());
								    						        			}
								    						        		}
								    						        	else{
								    						        		var z=s.getRate()+y*g;
								    						        		if(z<h){
								    						        			z=h;
								    						        			}
								    						        		if(z>m){
								    						        			z=m;
								    						        			}
								    						        		s.setRate(z);
								    						        		if(r){
								    						        			r.setValue(z);
								    						        			}
								    						        		}
								    						        	k();
								    						        	};
								    						        	t=function(){c(1)};
								    						        	f=function(){c(-1)};
								    						        	h=1;
								    						        	m=25;
								    						        	g=1;
								    						        	d="";
								    						        	o="";
								    						        	u="Speed %d fps";
								    						        	v="Frame %d";
								    						        	if(!s){
								    						        		return null;
								    						        		}
								    						        	if(p){
								    						        		j=document.getElementById(p);
								    						        		if(!j){
								    						        			return null;
								    						        			}
								    						        		}
								    						        	else{
								    						        		j=document.createElement("div");
								    						        		j.className="aep_panel";
								    						        		j.innerHTML="<button class='playpause pause'></button><button class='prev'></button><div class='slider'><div class='knob'></div></div><button class='next'></button><span class='slabel'>Speed: xx fps</span>";
								    						        		if(s.getPlayerDiv().nextSibling){
								    						        			s.getPlayerDiv().parentNode.insertBefore(j,s.getPlayerDiv().nextSibling);
								    						        			}
								    						        		else{
								    						        			s.getPlayerDiv().parentNode.appendChild(j);
								    						        			}
								    						        		}
								    						        	b=aep.cross.getFirstChildWithClass(j,"playpause");
								    						        	w=aep.cross.getFirstChildWithClass(j,"prev");
								    						        	x=aep.cross.getFirstChildWithClass(j,"next");
								    						        	n=aep.cross.getFirstChildWithClass(j,"slider");
								    						        	q=aep.cross.getFirstChildWithClass(j,"slabel");
								    						        	if(b){
								    						        		aep.cross.addListener(b,"click",a);
								    						        		}
								    						        	if(w){
								    						        		aep.makeButtonRepeater(w,f);
								    						        		}
								    						        	if(x){
								    						        		aep.makeButtonRepeater(x,t);
								    						        		}
								    						        	if(n){
								    						        		r=aep.makeSlider(n).setListener(l);
								    						        		if(s.isPaused()){
								    						        			r.setMin(0).setMax(s.getFrameCount()-1).setValue(s.getFrame());
								    						        			}
								    						        		else{
								    						        			r.setMin(h).setMax(m).setValue(s.getRate());
								    						        			}
								    						        		}
								    						        	k();
								    						        	return{
								    						        		setMinRate:function(y){
								    						        			h=y;
								    						        			if(r){
								    						        				r.setMin(y);
								    						        				}
								    						        			return this;
								    						        			},setMaxRate:function(y){
								    						        				m=y;
								    						        				if(r){
								    						        					r.setMax(y)
								    						        					}
								    						        				return this;
								    						        				},setRateInc:function(y){
								    						        					g=y;
								    						        					return this;
								    						        					},setButtonText:function(y){
								    						        						var z=y.split(";");
								    						        						d=z[0];
								    						        						o=z[1];
								    						        						i();
								    						        						return this;
								    						        						},setLabelText:function(y){
								    						        							var z=y.split(";");
								    						        							u=z[0];
								    						        							v=z[1];
								    						        							e();
								    						        							return this;
								    						        							}
								    						        						}
								    						        	},makeAllPlayers:function(){
								    						        		var b,a;
								    						        		b=aep.cross.getElementsByClassName("aeplayer","div");
								    						        		for(a=0;a<b.length;a++){
								    						        			aep.makePanel(aep.makePlayerByEl(b[a]).play());
								    						        			}
								    						        		}
								    						        	};

