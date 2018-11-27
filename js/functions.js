function rainbow() {
    var html = document.getElementsByTagName('html')[0];
    html.style.WebkitTransition = "all 2s";
    
    html.animate(html.style.cssText = "--main-bg-color: green");
}
