var dragsort = ToolMan.dragsort()
var junkdrawer = ToolMan.junkdrawer()

window.onload = function() {
	junkdrawer.restoreListOrder("phonetic1")

	dragsort.makeListSortable(document.getElementById("phonetic1"),
			verticalOnly, saveOrder)
}

function verticalOnly(item) {
	item.toolManDragGroup.verticalOnly()
}

function speak(id, what) {
	var element = document.getElementById(id);
	element.innerHTML = 'Clicked ' + what;
}

function saveOrder(item) {
	var group = item.toolManDragGroup
	var list = group.element.parentNode
	var id = list.getAttribute("id")
	if (id == null) return
	group.register('dragend', function() {
		ToolMan.cookies().set("list-" + id, 
				junkdrawer.serializeList(list), 365)
	})
}
