function doToggleClassName(obj, onClassName, offClassName){obj.className = (obj.className != onClassName) ? onClassName : offClassName;}
function getParentObj(obj){return obj.parentElement || obj.parentNode;}
function doReplaceClassName(findClassName, replaceClassName, targetTagName){
  var elements = document.getElementsByTagName(targetTagName || '*');
  for (var i = 0; i < elements.length; i++) {
    if (elements[i].className == findClassName)
      elements[i].className = replaceClassName;
  }
}