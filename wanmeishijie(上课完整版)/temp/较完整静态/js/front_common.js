function D ( id ) {
	return document.getElementById( id );
}
function D_T ( id, tag_name ) {
	var obj = D( id );
	return obj.getElementsByTagName( tag_name );
}