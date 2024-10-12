import Breadcrumbs from '@/Components/UI/Breadcrumbs';
import Footer from '@/Components/UI/Footer';
import Navbar from '@/Components/UI/Navbar';
import { type PropsWithChildren } from 'react';

const DashboardLayout = ({ children }: PropsWithChildren) => {
    return (
        <>
            <main className="min-h-[calc(100vh_-_93px)] bg-gray-100">
                <Navbar />
                <section className="mt-[93px] space-y-10 overflow-hidden px-24 py-12">
                    <Breadcrumbs />
                    <div className="space-y-6">{children}</div>
                </section>
            </main>
            <Footer />
        </>
    );
};

export default DashboardLayout;
