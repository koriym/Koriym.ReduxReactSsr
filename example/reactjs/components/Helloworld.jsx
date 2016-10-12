import React from 'react';

class HelloWorld extends React.Component {
  static propTypes = {
    name: React.PropTypes.string.isRequired,
  }
  static defaultProps = {
    name: 'World',
  }
  constructor(props) {
    super(props);
    this.state = {
      name: this.props.name
    };
  }
  handleClick() {
    this.setState({ name: 'CSR'});
  }
  render() {
    return (
        <div>
          <div>Hello {this.state.name}</div>
          <button onClick={ this.handleClick.bind(this)}>Click</button>
        </div>
    )
  }
}

export default HelloWorld;
