dojoConfig = {
    parseOnLoad: true,
    async: true,
    packages: [
        { name: "golfleague", location: "../golfleague" }],
    themeMap: [
        ["Android", "", [
            "themes/android/android.css"]],
        ["BlackBerry", "", [
            "themes/blackberry/blackberry.css"]],
        ["iPad", "", [
            "themes/ipad/ipad.css"]],
        ["iPhone", "", [
            "themes/iphone/iphone.css"]],
        [".*", "", [
            "themes/android/android.css"]]
    ],
    mblThemeFiles: [],
    mblLoadCompatPattern: ""
}
