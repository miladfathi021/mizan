// Vue.directive('outside-click', {
//     bind: function (el, binding, vnode) {
//         document.body.addEventListener('click', function (event) {
//             if (
//                 event.target === el
//             ) {
//                 vnode.context[binding.value.method](event);
//             }
//         });
//     }
// });


Vue.directive('click-outside', {
    bind: function (el, binding, vnode) {
        window.event = function (event) {
            if (!(el == event.target || el.contains(event.target)) && event.target.id !== binding.value.ref) {
                vnode.context[binding.value.method](event);
            }
        };
        document.body.addEventListener('click', window.event)
    },
    unbind: function (el) {
        document.body.removeEventListener('click', window.event)
    },
});
