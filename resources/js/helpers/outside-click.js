Vue.directive('outside-click', {
    bind: function (el, binding, vnode) {
        document.body.addEventListener('click', function (event) {
            if (
                event.target === el
            ) {
                vnode.context[binding.value.method](event);
            }
        });
    }
});
