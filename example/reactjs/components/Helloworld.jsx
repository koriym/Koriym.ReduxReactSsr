import React from 'react';

class HelloWorld extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      name: this.props.name
    };
  }
  _handleClick() {
    this.setState({ name: 'CSR'});
  }
  render() {
    return (
        <div>
          <div>Hello {this.state.name}</div>
          <button onClick={ this._handleClick.bind(this) }>Click</button>
        </div>
    )
  }
}

HelloWorld.propTypes = {
  name: React.PropTypes.string.isRequired,
};

HelloWorld.defaultProps = {
  name: 'World',
};

export default HelloWorld;
