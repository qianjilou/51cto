function D ( id ) {
	return document.getElementById( id );
}
/*
	var obj = document.getElementById(id);
	var tag_obj = obj.getElementByTagName(tag_name)
*/
function D_T ( id, tag_name ) {
	var obj = D( id );
	return obj.getElementsByTagName( tag_name );
}