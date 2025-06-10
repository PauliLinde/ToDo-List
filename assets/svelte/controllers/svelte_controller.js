//import { actions } from "App\Controller\ActionController.php";

import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static values = {
        component: String,
        props: Object
    }

    async connect() {
        try {
            const module = await import(`../svelte/controllers/${this.componentValue}.svelte`);
            const Component = module.default;

            new Component({
                target: this.element,
                props: this.propsValue || {}
            });
        } catch (error) {
            console.error('Error loading Svelte component:', error);
        }
    }
}
