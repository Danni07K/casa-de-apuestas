import './bootstrap';
import 'bootstrap';

// Close alert messages after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 300);
        }, 5000);
    });
});

// Confirm delete actions
document.addEventListener('submit', function(e) {
    if (e.target.matches('form') && e.target.querySelector('button[type="submit"].btn-danger')) {
        if (!confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
            e.preventDefault();
        }
    }
});
