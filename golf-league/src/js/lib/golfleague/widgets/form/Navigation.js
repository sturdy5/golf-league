define([
    "dojo/_base/declare",
    "dojo/dom-construct",
    "dojo/_base/lang",
    "dojo/_base/array",
    "dijit/_WidgetBase",
    "dijit/_TemplatedMixin",
    "dijit/_WidgetsInTemplateMixin",
    "dojo/text!./templates/Navigation.html"], function(declare, domConst, lang, arrayUtil, _WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin, template) {
        return declare([_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin], {
            templateString: template,

            constructor: function() {
                console.log("instantiated the navigation widget");
            }
        });
    }
);
