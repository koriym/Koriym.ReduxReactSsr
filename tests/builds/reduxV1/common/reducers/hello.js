import { HELLO_WORLD } from '../actions'

const hello = (state = { message: 'Hello CSR !' }, action) => {
  switch (action.type) {
    case HELLO_WORLD:
      return Object.assign({}, state, { message: 'Hello, World!' })
    default:
      return state
  }
}

export default hello
