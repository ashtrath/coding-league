import Footer from '@/Components/UI/Footer';
import Navbar from '@/Components/UI/Navbar';
import headerImage from '@assets/dashboard_header.jpg';
import { type PropsWithChildren } from 'react';

const MainDashboardLayout = ({ children }: PropsWithChildren) => {
    return (
        <>
            <main className="min-h-[calc(100vh_-_93px)]">
                <Navbar />
                <header className="relative mt-[93px] flex h-[240px] flex-col items-center justify-center text-white before:absolute before:inset-0 before:z-[-5] before:bg-gray-900/60">
                    <h1 className="mb-2 text-4xl font-semibold tracking-tight">
                        Selamat Datang di Dashboard CSR Kabupaten Cirebon
                    </h1>
                    <p className="text-2xl">
                        Lapor dan Ketahui Program CSR Anda
                    </p>
                    <img
                        className="absolute inset-0 -z-10 size-full w-full object-cover object-[50%_30%]"
                        src={headerImage}
                        alt="Kantor Bupati Cirebon"
                    />
                </header>
                <section className="min-w-full overflow-hidden bg-gray-100 px-24 py-12">
                    {children}
                </section>
            </main>
            <Footer />
        </>
    );
};

export default MainDashboardLayout;
