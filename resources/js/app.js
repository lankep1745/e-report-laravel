// Navigation indicator for Livewire wire:navigate
document.addEventListener('livewire:navigating', () => {
    let bar = document.getElementById('wire-nav-progress');
    if (!bar) {
        bar = document.createElement('div');
        bar.id = 'wire-nav-progress';
        bar.style.position = 'fixed';
        bar.style.top = '0';
        bar.style.left = '0';
        bar.style.height = '3px';
        bar.style.background = 'linear-gradient(90deg, #4f46e5, #6366f1, #38bdf8)';
        bar.style.zIndex = '999999';
        bar.style.transition = 'width 0.25s ease-out, opacity 0.3s ease';
        bar.style.width = '0%';
        bar.style.boxShadow = '0 0 10px rgba(99, 102, 241, 0.7)';
        document.body.appendChild(bar);
    }
    bar.style.opacity = '1';
    bar.style.width = '30%';
    setTimeout(() => {
        if (bar.style.width === '30%') {
            bar.style.width = '70%';
        }
    }, 150);
});

document.addEventListener('livewire:navigated', () => {
    const bar = document.getElementById('wire-nav-progress');
    if (bar) {
        bar.style.width = '100%';
        setTimeout(() => {
            bar.style.opacity = '0';
            setTimeout(() => {
                bar.style.width = '0%';
            }, 300);
        }, 150);
    }
});
