function moveOptions(fromList, toList) {
	// move all of the items in the fromList that are selected
	// to the toList
	var moveTheseChildren = new Array();
	for ( var i = 0; i < fromList.childNodes.length; i++) {
		var child = fromList.childNodes[i];
		if (child && child.selected == true) {
			child.selected = false;
			moveTheseChildren.push(child);
		}
	}

	for ( var i = 0; i < moveTheseChildren.length; i++) {
		var child = moveTheseChildren[i];
		fromList.removeChild(child);
		toList.appendChild(child);
	}
}

function getSelectorIds(list) {
	var result = "";
	for ( var i = 0; i < list.childNodes.length; i++) {
		if (list.childNodes[i].value) {
			if (result != "") {
				result += ",";
			}
			result += list.childNodes[i].value;
		}
	}
	return result;
}