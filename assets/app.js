import './bootstrap.js';
import './styles/app.css';
import { registerSvelteControllerComponents } from '@symfony/ux-svelte';

console.log('App.js loaded');

registerSvelteControllerComponents(
    require.context('./svelte/controllers', true, /\.svelte$/)
);

console.log('Svelte components registered');

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded');
    console.log('window.resolveSvelteComponent:', typeof window.resolveSvelteComponent);
    
    // Kolla olika selectors
    const allDivs = document.querySelectorAll('div');
    console.log('Total divs on page:', allDivs.length);
    
    const dataControllerElements = document.querySelectorAll('[data-controller]');
    console.log('Elements with data-controller:', dataControllerElements.length);
    dataControllerElements.forEach(el => console.log('Controller element:', el.outerHTML));
    
    const svelteElements = document.querySelectorAll('[data-controller="symfony--ux-svelte--svelte"]');
    console.log('Found Svelte elements:', svelteElements.length);
    
    // Kolla hela body innehållet
    console.log('Body innerHTML (first 500 chars):', document.body.innerHTML.substring(0, 500));
});
