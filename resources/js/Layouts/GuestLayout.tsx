import ApplicationLogo from '@/Components/Misc/ApplicationLogo';
import Footer from '@/Components/UI/Footer';
import { Link } from '@inertiajs/react';
import { PropsWithChildren } from 'react';

export default function Guest({ children }: PropsWithChildren) {
    return (
        <>
            <nav className="flex w-full items-center justify-center bg-white py-[18px]">
                <Link href="/">
                    <ApplicationLogo className="h-10" />
                </Link>
            </nav>
            <main className="flex min-h-[calc(100vh-76px-114px)] items-center bg-gray-200 px-24">
                <section className="min-w-full overflow-hidden rounded-xl border border-gray-300 bg-white">
                    {children}
                </section>
            </main>
            <Footer />
        </>
    );
}
