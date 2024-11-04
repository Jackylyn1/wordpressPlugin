interface APIState<Type> {
    error: string | null;
    loading: boolean;
    results: Type[];
}

export default APIState;