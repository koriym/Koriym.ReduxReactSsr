import React from 'react';

const HelloWorld = props => (
  <div>
    Hello {props.name}
  </div>
);

HelloWorld.propTypes = {
  name: React.PropTypes.string.isRequired,
};

HelloWorld.defaultProps = {
  name: 'World',
};

export default HelloWorld;
