import { actions } from 'App\Controller\ActionController.php';

export function load() {
    return {
        summaries: actions.map((action) => ({
            id: action.id,
            action: action.action,
            dueDate: action.dueDate
        }))
    };
}
