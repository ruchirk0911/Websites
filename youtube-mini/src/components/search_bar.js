import React,{ Component } from 'react';

class SearchBar extends Component {
    constructor(props){
        super(props);

        this.state = { term: '' };
    }
    //input => controlled component as its value is set by state.
    render() {
        return (
            <nav className="search-bar navbar navbar-toggleable-md navbar-light bg-faded">
                <a className="navbar-brand" href="#">YouTube-Mini</a>
                
                <input
                    placeholder= "Search..."
                    value ={this.state.term}
                    onChange ={event => this.onInputChange(event.target.value)}/>
                
            </nav>
        );
    }

    onInputChange(term){
        this.setState({term});
        this.props.onSearchTermChange(term);
    }
}

export default SearchBar;