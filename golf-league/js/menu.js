var showMenu = function() {
	require(["dojo/dom", "dojo/dom-class", "dojo/on"], function(dom, domClass, on) {
		domClass.remove("body", "active-sidebar");
		domClass.toggle("body", "active-nav");

		domClass.toggle("menu-button", "active-button");
	});
}

require(["dojo/on", "dojo/dom", "dojo/dom-class", "dojo/domReady!"], function(on, dom, domClass) {
	on(dom.byId("menu-button"), "click", function(e) {
		e.preventDefault();
		showMenu();
	});
	
	on(dom.byId("clear-btn"), "click", function(e) {
		e.preventDefault();
		domClass.remove("body", "active-nav");
	});
});