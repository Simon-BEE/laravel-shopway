window.livewire.on('flashMessage', param => {
    createAlert(param['type'], param['message'], param['id']);

    let flashAlertElements = document.querySelectorAll('.alert-flash');

    flashAlertElements.forEach(element => {
        alertTransition(element);
    });
});

// Alert animation
const flashAlertElement = document.querySelector('.alert-flash');
if (flashAlertElement) {
    alertTransition(flashAlertElement);
}

function alertTransition(alertElement){
    setTimeout(() => {
        alertElement.style.transform = 'translateX(0)';
    }, 500);
    setTimeout(() => {
        alertElement.style.transform = 'translateX(100%)';
    }, 5000);
    setTimeout(() => {
        removeElement(alertElement);
    }, 6500);
}

function createAlert(type, message, id) {
    if (!document.querySelector(`#alert-${id}`)) {
        const alertElement = document.createElement('div');
        alertElement.className = 'fixed right-0 top-0 mt-20 max-w-lg z-40 alert-flash transition-all duration-200 transform translate-x-full';
        alertElement.id = `alert-${id}`;
        alertElement.innerHTML = `
            <div class="px-4 py-3">
                <div class="inline-flex items-center bg-white leading-none rounded px-3 py-5 shadow-lg border-l-4 text-teal text-sm " id="alert-type-${id}">
                    <span class="inline-flex  rounded-full py-2 px-3 justify-center items-center" id="alert-icon-${id}">
                    </span>
                    <span class="inline-flex px-2 leading-4 text-gray-700" id="alert-content-${id}">
                    </span>
                </div>
            </div>
        `;
        document.querySelector('main').append(alertElement);
        if (type === 'success') {
            document.getElementById(`alert-type-${id}`).classList.add('text-green-500', 'border-green-500');
            document.getElementById(`alert-icon-${id}`).innerHTML = `<span class="mdi mdi-alert-circle-check-outline text-2xl"></span>`;
        } else {
            document.getElementById(`alert-type-${id}`).classList.add('text-red-500', 'border-red-500');
            document.getElementById(`alert-icon-${id}`).innerHTML = `<span class="mdi mdi-alert-remove-outline text-2xl"></span>`;
        }

        document.getElementById(`alert-content-${id}`).innerHTML = message;
    }
}

function removeElement(element) {
    element.parentNode.removeChild(element);
}