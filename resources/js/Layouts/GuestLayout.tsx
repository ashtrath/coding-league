import ApplicationLogo from '@/Components/Misc/ApplicationLogo';
import Footer from '@/Components/UI/Footer';
import { Link } from '@inertiajs/react';
import { PropsWithChildren } from 'react';

export default function Guest({ children }: PropsWithChildren) {
    return (
        <>
            <header className="flex w-full items-center justify-center border-b border-b-gray-300 bg-white py-[18px]">
                <Link href="/">
                    <ApplicationLogo className="h-10" />
                </Link>
            </header>
            <main className="flex min-h-[calc(100vh_-_76px)] items-center bg-gray-100 px-24 py-12">
                <section className="min-w-full overflow-hidden rounded-xl border border-gray-300 bg-white">
                    {children}
                </section>
            </main>
            <Footer />
        </>
    );
}
