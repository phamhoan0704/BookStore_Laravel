const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const tabs = $$(".tabs-item");
const panes = $$(".tabs-pane");

const tabActive = $(".tabs-item.active");
const line = $(".tab-line");

requestIdleCallback(function() {
    line.style.left = tabActive.offsetLeft + "px";
    line.style.width = tabActive.offsetWidth + "px";
});

tabs.forEach((tab, index) => {
    const pane = panes[index];

    tab.onclick = function() {
        $(".tabs-item.active").classList.remove("active");
        $(".tabs-pane.active").classList.remove("active");

        line.style.left = this.offsetLeft + "px";
        line.style.width = this.offsetWidth + "px";

        this.classList.add("active");
        pane.classList.add("active");
    };
});