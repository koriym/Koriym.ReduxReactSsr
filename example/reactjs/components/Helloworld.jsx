import React from 'react';

class HelloWorld extends React.Component {
  static propTypes = {
    name: React.PropTypes.string.isRequired,
  }
  constructor(props) {
    super(props);
    this.state = {
      name: this.props.name
    };
  }
  handleClick() {
    this.setState({ name: 'World'});
  }
  render() {
    return (
        <div>
          <h1>Hello {this.state.name}</h1>
          <button onClick={ this.handleClick.bind(this)}>Click</button>
        </div>
    )
  }
}

export default HelloWorld;
