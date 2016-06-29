var React = require('react');
var ReactDOM = require('react-dom');
var { Router, Route, IndexRoute, Link, browserHistory } = require('react-router');
var axios = require('axios');

var App = React.createClass({
  render: function() {
    return (
      <div className="app-container container-fluid">
      	
        <div className="row app-nav">
            <div className="navbar navbar-fixed-top navbar-dark bg-inverse">
                <a className="navbar-brand" href="#">Stockdash</a>
            </div>
        </div>

        {this.props.children}

      </div>
    );
  }
});

var DashboardLayout = React.createClass({
  render: function() {
    return (
      <div className="row app-main">
        <InstanceListContainer />
        <SymbolViewer />
      </div>
      );
  }
});

var InstanceListContainer = React.createClass({

  getInitialState() {
    return {
      instances: []
    };
  },

  componentDidMount() {
      var _this = this;
      axios.get('/instance').then(function(response){
        console.log(response)
        _this.setState({instances:response.data})
      })
  },

  render() {
    return( <InstanceList instances={this.state.instances} /> );
  }

});

var InstanceList = React.createClass({
  render: function(){
    return (
      <div className="instance-list col-xs-2">
        <ul className="list-group row">
        { this.props.instances.map(function(instance) {
          return ( 
              <li key={instance.id} className="instance-panel-item list-group-item">{instance.symbol.symbol}</li>
          );
        })}
        </ul>
      </div>
    );
  }
});

var SymbolViewer = React.createClass({
  render: function() {
    return(
      <div className="symbol-panel col-xs-10">Hello Symbol</div>
    );
  }
})


ReactDOM.render(
  <Router history={browserHistory} >
    <Route component={App} >
      <Route path="/" component={DashboardLayout} />
    </Route>
  </Router>,
  document.getElementById('app-root')
);