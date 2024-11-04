import APIComponent from './APIComponent';
import '../assets/css/articlesGrid.css';
import APIState from '../contracts/apiState';
import Article from '../contracts/article';
import UserList from './userList';
import CategoriesList from './categoriesList';

class ResultsGrid extends APIComponent <{}, APIState<Article>> {
    apiEndpoint: string;

    constructor(props: any) {
        super(props);
        this.apiEndpoint = 'posts?per_page=12&order=desc';
    }

    render() {
        const { results, loading, error } = this.state;
        if (loading) {
            return <p>Lade Artikel...</p>;
        }

        if (error) {
            return <p>{error}</p>;
        }
        return (
        <div className="results-grid">
            {results.map((article: any) => (
            <div key={article.id} className="article-tile">
                <img src={article.rumble_app_meta?.featured_image?.url} alt={article.rumble_app_meta?.featured_image?.alt_text} 
                className="article-image" style={{ maxWidth: article.rumble_app_meta?.featured_image?.width ? `${article.rumble_app_meta.featured_image.width}px` : 'auto' }}/>
                <p className="article-category"><CategoriesList categoryId={article.categories.join(',')} /></p>
                <h2 className="article-title">{article.title.rendered}</h2>
                <p className="article-author"><UserList userId={article.author} /></p>
            </div>
            ))}
        </div>
        );
    }
}

export default ResultsGrid;