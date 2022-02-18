import ReducerAction from './ReducerAction'
export default (state, action) => {
    switch (action.type) {
        case ReducerAction.error:
            return {
                ...state,
                error: {
                    type: action.status,
                    message: action.payload
                }
            }
        case ReducerAction.updateAppstate:
            return {
                ...state,
                stateUpdate: Math.random()
            }
        default:
            return state
    }
}