//var white_mobiles = new Array("13917417305", "13917197170", "18616098953", "13795375382");
var white_mobiles = new Array();

function isWhiteBox(mobile) {
	for (var i = 0; i < white_mobiles.length; i++) {
		if (white_mobiles[i] == mobile) {
			return true;
		}
	}
	return false;
} 