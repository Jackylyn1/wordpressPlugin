import { Component } from "react";
import APIState from "../contracts/apiState";

abstract class APIComponent<PropsType, StateType extends APIState<any>> extends Component<PropsType, StateType> {
    abstract apiEndpoint: string;
    constructor(props: PropsType) {
        super(props);
        this.state = {
            error: null,
            loading: true,
            results: []
        } as unknown as StateType;
    }

    componentDidMount() {
        this.fetchResults();
    }
    
    async fetchResults() {
        try {
            const response = await fetch('https://www.ruhrnachrichten.de/wp-json/wp/v2/' + this.apiEndpoint);
            const jsonResponse = await response.json();
            this.setState({ results: jsonResponse, loading: false });
        } catch (error) {
            this.setState({ error: 'Fehler beim Abrufen der Daten', loading: false });
        }
    }
}

export default APIComponent;