import { cn } from '@/lib/utils';
import { RiUploadCloud2Line } from '@remixicon/react';
import { useEffect, useState } from 'react';
import { type DropzoneProps, useDropzone } from 'react-dropzone';

interface FileUploadProps extends DropzoneProps {
    className?: string;
    onFilesUploaded: (files: File[]) => void;
}

const FileUpload = ({
    onFilesUploaded,
    maxFiles = 1,
    className,
    ...props
}: FileUploadProps) => {
    const [previews, setPreviews] = useState<string[]>([]);

    const { getRootProps, getInputProps, isDragActive, acceptedFiles } =
        useDropzone({
            onDrop: (acceptedFiles: File[]) => {
                onFilesUploaded(acceptedFiles);

                const preview = acceptedFiles.map((file) =>
                    URL.createObjectURL(file),
                );
                setPreviews(preview);
            },
            ...props,
        });

    const acceptedFormats = props.accept
        ? Object.values(props.accept)
              .flat()
              .map((ext) => ext.replace('.', '').toUpperCase())
              .join(', ')
        : 'Any';

    useEffect(() => {
        return () => previews.forEach((url) => URL.revokeObjectURL(url));
    }, [previews]);

    return (
        <div
            className={cn(
                'flex cursor-pointer flex-col justify-center space-y-3 rounded-lg border border-gray-300 p-4 pb-6',
                isDragActive ? 'bg-gray-100' : 'bg-white',
                className,
            )}
            {...getRootProps()}
        >
            <input {...getInputProps()} />
            {previews.length > 0 ? (
                <div
                    className={cn(
                        'grid',
                        maxFiles > 1 ? 'grid-cols-3' : 'grid-cols-1',
                    )}
                >
                    {previews.map((preview, index) => (
                        <div key={index} className="relative size-72">
                            <img
                                src={preview}
                                alt={`Preview ${index}`}
                                onLoad={() => URL.revokeObjectURL(preview)}
                                className="size-72 rounded-lg object-contain"
                            />
                            <div className="absolute inset-0 z-10 flex flex-col justify-end rounded-lg bg-gradient-to-t from-black/70 to-transparent p-2">
                                <p className="bottom-0 text-sm font-semibold text-white">
                                    {acceptedFiles[index].name}
                                </p>
                                <p className="bottom-0 text-sm font-semibold text-white">
                                    {(
                                        acceptedFiles[index].size /
                                        (1024 * 1024)
                                    ).toFixed(2)}{' '}
                                    MB
                                </p>
                            </div>
                        </div>
                    ))}
                    {/* {maxFiles > 1 && (
                        <div className="grid size-72 place-content-center place-items-center rounded-lg border-2 border-dashed border-brand">
                            <div className="size-fit self-center rounded-full border-[6px] border-red-100 bg-red-200 p-2 text-brand">
                                <RiUploadCloud2Line className="size-5" />
                            </div>
                            <div className="space-y-1 text-center text-sm font-medium text-gray-600">
                                <p>
                                    <span className="font-semibold text-brand">
                                        Klik untuk unggah
                                    </span>{' '}
                                    atau seret dan lepas disini
                                </p>
                                <p>
                                    {acceptedFormats}{' '}
                                    {props.maxSize &&
                                        `up to ${(props.maxSize / (1024 * 1024)).toFixed(0)} MB`}
                                </p>
                            </div>
                        </div>
                    )} */}
                </div>
            ) : (
                <>
                    <div className="size-fit self-center rounded-full border-[6px] border-red-100 bg-red-200 p-2 text-brand">
                        <RiUploadCloud2Line className="size-5" />
                    </div>
                    <div className="space-y-1 text-center text-sm font-medium text-gray-600">
                        <p>
                            <span className="font-semibold text-brand">
                                Klik untuk unggah
                            </span>{' '}
                            atau seret dan lepas disini
                        </p>
                        <p>
                            {acceptedFormats}{' '}
                            {props.maxSize &&
                                `up to ${(props.maxSize / (1024 * 1024)).toFixed(0)} MB`}
                        </p>
                    </div>
                </>
            )}
        </div>
    );
};

export default FileUpload;
