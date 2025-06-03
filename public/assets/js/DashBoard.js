    function openTab(tabName) {
        var tabs = document.querySelectorAll('.tab-content');
        tabs.forEach(function(tab) {
            tab.classList.remove('active');
        });
        document.getElementById(tabName).classList.add('active');
    }

    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab');
        if (tab === 'alimentos') {
            openTab('alimentos');
        } else {
            openTab('usuarios');
        }
    }