import 'alpinejs';

// Alert animation
const flashAlertElement = document.querySelector('.alert-flash');
if (flashAlertElement) {
    setTimeout(() => {
        flashAlertElement.style.transform = 'translateX(0)';
    }, 1000);
    setTimeout(() => {
        flashAlertElement.style.transform = 'translateX(100%)';
    }, 5000);
}
