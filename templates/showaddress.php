<template>
  <div style="margin:auto; display:table">
    <div class="msgbox"></div>
    <script>
      var addresstt=domelementsrootmother.getChild().getNextChild({name:"labels"}).getNextChild({name:"middle"}).getNextChild({name:"loggedin"}).getNextChild({name:"addresstt"});
      addresstt.getRelationship("domelementsdata").getChild().writeProperty(thisElement);
      //adding the edition pencil
      var launcher = new Node();
      launcher.thisNode = addresstt.getRelationship("domelementsdata").getChild();
      launcher.editElement = thisElement;
      launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
    </script>
  </div>
  <div></div>
  <script>
    webuser.refreshView(thisElement,"templates/useraddress.php");
  </script>
  <div style="margin:auto; display:table;">
    <button class="btn"></button>
    <script>
      var bckloginlabel=domelementsrootmother.getChild().getNextChild({name:"labels"}).getNextChild({name:"middle"}).getNextChild({name:"loggedin"}).getNextChild({name:"backToLoginLb"});
      bckloginlabel.getRelationship("domelementsdata").getChild().writeProperty(thisElement);
      //adding the edition pencil
      var launcher = new Node();
      launcher.thisNode = bckloginlabel.getRelationship("domelementsdata").getChild();
      launcher.editElement = thisElement;
      launcher.createInput=true;
      launcher.visibility="visible";
      launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
      thisElement.onclick=function(){
	(new Node()).refreshView(document.getElementById("centralcontent"), "templates/loggedindata.php");
      }
    </script>
  </div>
</template>