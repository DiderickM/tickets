
function list(){
    var rowSize = 100; // => container height / number of items
    var container = document.querySelector(".container");
    var listItems = Array.from(document.querySelectorAll(".list-item")); // Array of elements
    var sortables = listItems.map(Sortable); // Array of sortables
    var total = sortables.length;

    TweenLite.to(container, 0.5, { autoAlpha: 1 });

    function changeIndex(item, to) {

        // Change position in array
        arrayMove(sortables, item.index, to);

        // Change element's position in DOM. Not always necessary. Just showing how.
        if (to === total - 1) {
            container.appendChild(item.element);
        } else {
            var i = item.index > to ? to : to + 1;
            container.insertBefore(item.element, container.children[i]);
        }

        // Set index for each sortable
            sortables.forEach(function (sortable, index) {return sortable.setIndex(index);});
    }

    function Sortable(element, index) {

        var content = element.querySelector(".item-content");
        var order = element.querySelector(".order");

        var animation = TweenLite.to(content, 0.3, {
        boxShadow: "rgba(0,0,0,0.2) 0px 16px 32px 0px",
        force3D: true,
        scale: 1.1,
        paused: true });


        var dragger = new Draggable(element, {
        onDragStart: downAction,
        onRelease: upAction,
        onDrag: dragAction,
        cursor: "inherit",
        type: "y" });


        // Public properties and methods
        var sortable = {
        dragger: dragger,
        element: element,
        index: index,
        setIndex: setIndex };


        TweenLite.set(element, { y: index * rowSize });

        function setIndex(index) {

        sortable.index = index;
        order.textContent = index + 1;

        // Don't layout if you're dragging
        if (!dragger.isDragging) layout();
        }

        function downAction() {
            animation.play();
            this.update();
        }

        function dragAction() {

            // Calculate the current index based on element's position
            var index = clamp(Math.round(this.y / rowSize), 0, total - 1);

            if (index !== sortable.index) {
            changeIndex(sortable, index);
            }
        }

        function upAction() {
            animation.reverse();
            layout();
        }

        function layout() {
            TweenLite.to(element, 0.3, { y: sortable.index * rowSize });
        }

        return sortable;
    }

    // Changes an elements's position in array
    function arrayMove(array, from, to) {
        array.splice(to, 0, array.splice(from, 1)[0]);
    }

    // Clamps a value to a min/max
    function clamp(value, a, b) {
        return value < a ? a : value > b ? b : value;
    }
}