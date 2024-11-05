import APIComponent from "./APIComponent";
import APIState from "../contracts/apiState";
import Category from "../contracts/category";

class CategoriesList extends APIComponent <{ categoryId: string }, APIState<Category>> {
    apiEndpoint: string;

    constructor(props: any){
        super(props);
        this.apiEndpoint = `categories?include=${props.categoryId || ''}`;
    }

    render() {
        const { results, loading, error } = this.state;
        if (loading) {
            return <p>Lade Kathegorie...</p>;
        }

        if (error) {
            return <p>{error}</p>;
        }
        return (
            <div className="categoriesList">
            {results.flatMap((category: any, i) => ([
                i> 0 && ', ',
                <span className="categoryName">{category.name}</span>
            ]))}
            </div>
        );
        
    }

}

export default CategoriesList;