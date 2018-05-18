<nav></nav>
<template id="menutp">
  <span class="adminlauncher adminsinglelauncher">
    <a href=""></a>
    <script>
      thisElement.textContent=thisNode.properties.innerHTML || labelsRoot.getNextChild({name: "not located"}).getNextChild({name: "emptyvallabel"}).properties.innerHTML;
      if (thisNode.selected) setSelected.call(thisElement.parentElement);
      thisElement.onclick=function(){
	thisNode.setActive();
	var jsonparameters={action: "load my tree"};
	var myForm=document.getElementById("formgeneric").cloneNode(true);
	myForm.elements.parameters.value=JSON.stringify(jsonparameters);
	thisNode.setView(myForm);
	thisNode.loadfromhttp(myForm, function() {
	  var elements=thisNode.getRelationship({"name":"domelements"});
	  elements.addEventListener("refreshChildrenView", function() {
	    if (this.children==0){
	      var element=this.addChild(new NodeMale());
	      element.myTp=document.getElementById("nochildrentp").content;
	      element.myContainer=this.childContainer;
	      element.refreshView();
	    }
	  });
	  elements.refreshChildrenView(document.getElementById("centralcontent"), document.querySelector("#menucontainer #domelementtp").content);
	});
	return false;
      };
    </script>
    <div class="bttopadmn"></div>
    <div class="btrightnarrow"></div>
    <script>
      if (webuser.isWebAdmin()) {
	var admnlauncher=new NodeMale();
	admnlauncher.myNode=thisNode;
	admnlauncher.buttons=[
	  { 
	    template: document.getElementById("butedittp"),
	    args:{editpropertyname:"innerHTML", allowedHTML:false, editelement:thisElement.parentElement.firstElementChild}
	  },
	  {template: document.getElementById("buthchpostp")},
	  {template: document.getElementById("butaddnodetp")},
	  {template: document.getElementById("butdeletetp")}
	];
	admnlauncher.refreshView(thisElement, document.getElementById("butopentp"));
      }
      webuser.addEventListener("log", function() {
	  if (!this.isWebAdmin()) {
	    thisElement.innerHTML='';
	    thisElement.previousElementSibling.innerHTML="";
	  }
	  else {
	    thisNode.setView(thisElement.nextElementSibling);
	  }
      }, "category" + thisNode.properties.id);
      thisNode.addEventListener("deleteNode", function() {
	webuser.removeEventListener("log", "category" + thisNode.properties.id);
      });
    </script>
  </span>
</template>

<template id="domelementtp">
  <div class="paragraph">
    <div class="adminlauncher adminsinglelauncher">
      <div></div>
      <script>
	thisElement.innerHTML=thisNode.properties.innerHTML ||
	labelsRoot.getNextChild({name: "not located"}).getNextChild({name: "emptyvallabel"}).properties.innerHTML;
	thisNode.setView(thisElement);
      </script>
      <div class="btinside"></div>
      <script>
	if (webuser.isWebAdmin()) {
	  var admnlauncher=new NodeMale();
	  admnlauncher.myNode=thisNode;
	  admnlauncher.buttons=[
	    { 
	      template: document.getElementById("butedittp"),
	      args:{editpropertyname:"innerHTML", allowedHTML:true, editelement:thisElement.parentElement.firstElementChild}
	    },
	    {template: document.getElementById("butvchpostp")},
	    {template: document.getElementById("butaddnodetp")},
	    {template: document.getElementById("butdeletetp")}
	  ];
	  admnlauncher.refreshView(thisElement, document.getElementById("admnbutstp"));
	}
      </script>
    </div>
  </div>
</template>

<script type="text/javascript">
webuser.addEventListener("loadses", function(){
  var menusroot=domelementsroot.getNextChild({name: "texts"});
  var myForm=document.getElementById("formgeneric").cloneNode(true);
  myForm.elements.parameters.value=JSON.stringify({action:"load my children"});
  var myrel=menusroot.cloneRelationship();
  myrel.setView(myForm);
  myrel.loadfromhttp(myForm, function(){
    menusroot=this.getChild({name: "nav"});
    var myForm=document.getElementById("formgeneric").cloneNode(true);
    myForm.elements.parameters.value=JSON.stringify({action:"load my children"});
    var myrel=menusroot.cloneRelationship();
    myrel.setView(myForm);
    myrel.loadfromhttp(myForm, function(){
      this.addEventListener("refreshChildrenView", function() {
	if (this.children==0){
	  var element=this.addChild(new NodeMale());
	  element.myTp=document.getElementById("nochildrentp").content;
	  element.myContainer=this.childContainer;
	  element.refreshView();
	}
      });
      //When admin add a new node it will be selected
      this.addEventListener("addNewNode", function(newnodeadded) {
	newnodeadded.getMyDomNodes()[0].querySelector("a").click();
      });
      //When admin delete a node si estaba seleccionado seleccionamos otro y si era el último borramos lo de la parte central
      this.addEventListener("deleteNode", function(nodedeleted) {
	if (nodedeleted.selected) {
	  if (this.children.length>0 && this.children[0].properties.id) {
	    this.children[0].getMyDomNodes()[0].querySelector("a").click();
	  }
	}
	if (this.children.length==1 && !this.children[0].properties.id) {
	  //remove subcategories flaps in case we just remove all categories
	  document.getElementById("centralcontent").innerHTML='';
	}
      });
      //showing menus (after the listeners to refreshChildrenView are added). Refreshing first time first menu is clicked
      this.refreshChildrenView(document.querySelector("#menucontainer nav"), document.querySelector("#menucontainer #menutp").content, function(){
	if (this.children.length>0 && !webuser.isWebAdmin()) this.children[0].getMyDomNodes()[0].querySelector("a").click();
      });
    });
  });
});
</script>