export interface User {
    id: string;
    full_name?: string;
    email: string;
    email_verified_at?: string;
    image?: string;
    role: 'Admin' | 'Mitra';
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
};
