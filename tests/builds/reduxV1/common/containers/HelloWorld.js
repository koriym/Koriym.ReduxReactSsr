import { connect } from 'react-redux'
import { helloWorld } from '../actions'
import Hello from './../components/Hello'

const mapStateToProps = (state) => {
  return {
    message: state.hello.message
  }
}

const mapDispatchToProps = (dispatch) => {
  return {
    onClick: () => {
      dispatch(helloWorld())
    }
  }
}

const HelloWorld = connect(
  mapStateToProps,
  mapDispatchToProps
)(Hello)

export default HelloWorld
