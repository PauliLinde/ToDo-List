import { startStimulusApp } from '@symfony/stimulus-bridge';

console.log('Bootstrap.js loaded');

const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.[jt]sx?$/
));

console.log('Stimulus app started:', app);

// Debug
setTimeout(() => {
    const controllers = Object.keys(app.controllersByIdentifier || {});
    console.log('Registered controllers:', controllers);
}, 1000);

// Exportera both app and application
export { app };
export const application = app;
