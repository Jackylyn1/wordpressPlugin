import APIComponent from "./APIComponent";
import APIState from "../contracts/apiState";
import User from "../contracts/user";

class UserList extends APIComponent <{ userId: number }, APIState<User>> {
    apiEndpoint: string;

    constructor(props: any){
        super(props);
        this.apiEndpoint = `users?include=${props.userId || ''}`;
    }

    render() {
        const { results, loading, error } = this.state;
        if (loading) {
            return <p>Lade Autor...</p>;
        }

        if (error) {
            return <p>{error}</p>;
        }
        return (
            <div className="userList"> Von: 
            {results.map((user: any) => (
                <span className="userName"> {user.name}</span>
            ))}
            </div>
        );
        
    }

}

export default UserList;